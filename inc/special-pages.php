<?php

if( ! is_admin() ){
    return;
}



final class WPKama_Special_Pages {

    public static  $SPECIAL = [
        'page' => [
            'shapka-ua',
            'shapka-ru',
        ]
    ];

    public static function init(){

        add_filter( 'display_post_states', [ __CLASS__, 'mark_in_post_list_page' ], 10, 2 );

        add_action( 'pre_trash_post', [ __CLASS__, 'restrict_post_deletion' ], 10, 2 );
        add_filter( 'pre_delete_post', [ __CLASS__, 'restrict_post_deletion' ], 10, 2 );

        add_filter( 'page_row_actions', [ __CLASS__, 'remove_row_action' ], 10, 2 );
    }

    public static function mark_in_post_list_page( array $post_states, $post ): array {

        if($post->post_type == 'setup'){
            $post_states[] = '<small>SYSTEM</small>';
        }

        return $post_states;
    }

    public static function remove_row_action( array $actions, $post ): array {

        if( self::is_post_in_list( $post ) ){
            unset( $actions['delete'] );
        }

        return $actions;
    }

    public static function restrict_post_deletion($delete, $post){

        if($post->post_type == 'setup'){
            /** @noinspection ForgottenDebugOutputInspection */
            wp_die( "`$post->post_name` page can not be deleted - it is special page." );
        }

        return $delete;
    }

    private static function is_post_in_list( $post ): bool {

        if( empty( $post->post_type ) ){
            return false;
        }

        $list = self::$SPECIAL[ $post->post_type ] ?? [];

        return in_array( $post->post_name, $list, true );
    }

}