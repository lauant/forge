import { xhr, getCookie, setCookie, unSlugify } from '../utility';

const getTagFromClass = el => [...el.classList].filter( btnClass => btnClass.includes("issuer-") )[0];

[...document.querySelectorAll( `.sba-following .elementor-button-text` )].map( btnText => btnText.setAttribute("data-text", btnText.innerHTML ) );

const updateFollowing = issuerTags => {
    const tags = issuerTags || [];

    [...document.querySelectorAll('.sba-following')].map( mailChimpBtn => {
        const tag = getTagFromClass( mailChimpBtn ) ? getTagFromClass( mailChimpBtn ) : '';
        if( tag ){
            [...document.querySelectorAll( `.${tag} .elementor-button-text` )].map( btnText => {
                btnText.innerHTML = tags.includes( tag ) ? 'Unfollow' : btnText.dataset.text;
            });
        }
        mailChimpBtn.setAttribute('data-following', tags.includes( tag ) ? true : false );
    });
}

[...document.querySelectorAll('.sba-following')].map( mailChimpBtn => {
    mailChimpBtn.addEventListener("click", function(e){
        let storedTags   = getCookie('clearlist_tags') ? JSON.parse( getCookie('clearlist_tags') ) : [];
        const currentTag = getTagFromClass( mailChimpBtn );
        const email      = getCookie('clearlist_email');
        let following    = this.dataset.following;
        let filteredTags;

        if( following === "true" ){
            filteredTags = storedTags.filter( tag => tag !== currentTag );
        }else{
            filteredTags = [...storedTags, currentTag ]
        }

        setCookie('clearlist_tags', JSON.stringify( filteredTags ) )
        updateFollowing( filteredTags );

        const unslugifiedTag =  unSlugify( currentTag.slice( 7 ) );
        xhr({
            payload: {following, email, tag: unslugifiedTag }
        },response => { });
    });
});

let initialTags = getCookie('clearlist_tags') ? JSON.parse( getCookie('clearlist_tags') ) : [];
updateFollowing( initialTags );