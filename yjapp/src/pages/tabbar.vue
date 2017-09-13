<template>
	<f7-page name="app" class="app-page">
		<f7-navbar theme="white">
			<f7-nav-left>
				<f7-link href="/settings" icon="icon icon-setting" v-show="activedTab === 'home'"></f7-link>
			</f7-nav-left>
			<f7-nav-center sliding><span class="icon icon-logo"></span></f7-nav-center>
			<!-- <f7-nav-center sliding>{{navbarTitle}}</f7-nav-center> -->
			<f7-nav-right>
				<f7-link icon="icon icon-scancode" icon-size="22" v-show="activedTab === 'home'"></f7-link>
			</f7-nav-right>
		</f7-navbar>
		<f7-tabs>
			<f7-tab route-tab-id="home" active/>
			<f7-tab route-tab-id="order" />
			<f7-tab route-tab-id="cart" />
			<f7-tab route-tab-id="member" />
		</f7-tabs>
		<f7-toolbar tabbar labels>
			<f7-link href="/app/home/" route-tab-link="#home" icon="icon icon-tab-home" active></f7-link>
			<f7-link href="/app/order/" route-tab-link="#order" icon="icon icon-tab-order"></f7-link>
			<f7-link href="/app/cart/" route-tab-link="#cart" icon="icon icon-tab-cart"></f7-link>
			<f7-link href="/app/member/" route-tab-link="#member" icon="icon icon-tab-member"></f7-link>
		</f7-toolbar>
	</f7-page>
</template>

<script>
</script>

<style>

</style>