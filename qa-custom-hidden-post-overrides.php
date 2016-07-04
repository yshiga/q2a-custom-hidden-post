<?php

function qa_page_q_post_rules($post, $parentpost=null, $siblingposts=null, $childposts=null)
{

	$rules = qa_page_q_post_rules_base($post, $parentpost, $siblingposts, $childposts);

	// コメントは全て表示可能にしておいてレイヤーで見た目を変更する
	if ($post['basetype'] == 'C') {
		$rules['viewable'] = true;
	// 回答は表示可能かつコメントを投稿したいのでコメント投稿可にする
	} elseif ($post['basetype'] = 'A') {
		$rules['viewable'] = true;
		$rules['commentbutton'] = (($post['type']=='Q') || ($post['type']=='A') || ($post['type']=='A_HIDDEN')) &&
			($permiterror_post_c!='level') && qa_opt(($post['type']=='Q') ? 'comment_on_qs' : 'comment_on_as');
		$rules['commentable'] = $rules['commentbutton'] && !$permiterror_post_c;
	}

	return $rules;
}
