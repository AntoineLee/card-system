<?php
namespace App\Http\Controllers\Merchant; use App\Library\Helper; use App\Library\Response; use App\System; use Illuminate\Http\Request; use App\Http\Controllers\Controller; class Category extends Controller { function get(Request $spdd9f33) { $sp6f7226 = $spdd9f33->post('current_page', 1); $spaba533 = $spdd9f33->post('per_page', 20); $sp26c3c2 = $this->authQuery($spdd9f33, \App\Category::class); $sp282adb = $spdd9f33->post('search', false); $spb80b3f = $spdd9f33->post('val', false); if ($sp282adb && $spb80b3f) { if ($sp282adb == 'simple') { return Response::success($sp26c3c2->get(array('id', 'name'))); } elseif ($sp282adb == 'id') { $sp26c3c2->where('id', $spb80b3f); } else { $sp26c3c2->where($sp282adb, 'like', '%' . $spb80b3f . '%'); } } $spc08eb6 = $spdd9f33->post('enabled'); if (strlen($spc08eb6)) { $sp26c3c2->whereIn('enabled', explode(',', $spc08eb6)); } $spec1114 = $sp26c3c2->withCount('products')->orderBy('sort')->paginate($spaba533, array('*'), 'page', $sp6f7226); foreach ($spec1114->items() as $sp8d0209) { $sp8d0209->setAppends(array('url')); } return Response::success($spec1114); } function sort(Request $spdd9f33) { $sp403bd7 = (int) $spdd9f33->post('id', -1); if (!$sp403bd7) { return Response::forbidden(); } $sp8d0209 = $this->authQuery($spdd9f33, \App\Category::class)->findOrFail($sp403bd7); $sp8d0209->sort = (int) $spdd9f33->post('sort', 1000); $sp8d0209->save(); return Response::success(); } function edit(Request $spdd9f33) { $sp403bd7 = (int) $spdd9f33->post('id'); $spa8020b = $spdd9f33->post('name'); $spc08eb6 = (int) $spdd9f33->post('enabled'); $sp2f9709 = $spdd9f33->post('sort'); $sp2f9709 = $sp2f9709 === NULL ? 1000 : (int) $sp2f9709; if (System::_getInt('filter_words_open') === 1) { $spcc0fad = explode('|', System::_get('filter_words')); if (($sp123706 = Helper::filterWords($spa8020b, $spcc0fad)) !== false) { return Response::fail('提交失败! 分类名称包含敏感词: ' . $sp123706); } } if ($sp2f9709 < 0 || $sp2f9709 > 1000000) { return Response::fail('排序需要在0-1000000之间'); } $sp1659fb = $spdd9f33->post('password'); $sp18ba38 = $spdd9f33->post('password_open') === 'true'; $sp8d0209 = $this->authQuery($spdd9f33, \App\Category::class)->find($sp403bd7); if (!$sp8d0209) { $sp8d0209 = new \App\Category(); $sp8d0209->user_id = $this->getUserIdOrFail($spdd9f33); } $sp8d0209->name = $spa8020b; $sp8d0209->sort = $sp2f9709; $sp8d0209->password = $sp1659fb; $sp8d0209->password_open = $sp18ba38; $sp8d0209->enabled = $spc08eb6; $sp8d0209->saveOrFail(); return Response::success(); } function enable(Request $spdd9f33) { $sp12219c = $spdd9f33->post('ids', ''); if (strlen($sp12219c) < 1) { return Response::forbidden(); } $spc08eb6 = (int) $spdd9f33->post('enabled'); $this->authQuery($spdd9f33, \App\Category::class)->whereIn('id', explode(',', $sp12219c))->update(array('enabled' => $spc08eb6)); return Response::success(); } function delete(Request $spdd9f33) { $sp12219c = $spdd9f33->post('ids', ''); if (strlen($sp12219c) < 1) { return Response::forbidden(); } $this->authQuery($spdd9f33, \App\Category::class)->whereIn('id', explode(',', $sp12219c))->delete(); return Response::success(); } }