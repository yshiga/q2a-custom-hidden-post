<?php

function qa_page_q_post_rules($post, $parentpost=null, $siblingposts=null, $childposts=null)
{

	$rules = qa_page_q_post_rules_base($post, $parentpost, $siblingposts, $childposts);

	// コメントは全て表示可能にしておいてレイヤーで見た目を変更する
	if ($post['basetype'] == 'C') {
		$rules['viewable'] = true;
	}

	return $rules;
}
