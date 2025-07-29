<?php

return [
    /* 
     * | When true, email validation relies only on the custom list. 
     * | When false, it checks both the custom and internal lists.
     * | Recommended: false — the internal list is already in place and feeling a bit lonely.
     */
    "only_custom" => false,

    /* 
     * | The internal list is based on the repository https://github.com/mixmaxhq/role-based-email-addresses/blob/master/src/index.js
     * | You might want to add more role-based emails like 'admin', 'support', or 'noreply'.  
     * | (No worries — these are already included. You’re ahead of the game 😝)
     */
    "list" => [],
];
