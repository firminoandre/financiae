import Cookie from "js-cookie";
export default {
    auth(to, from, next){
        const token = Cookie.get('token_')
        if(!token){
            // not existing cookie, return to login page
            next('/entrar')
        }
        // existing cookie, return to home page
        next();
    }
}