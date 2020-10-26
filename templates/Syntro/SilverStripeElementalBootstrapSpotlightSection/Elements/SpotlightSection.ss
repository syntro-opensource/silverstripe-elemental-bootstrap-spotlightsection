<div class="row justify-content-center text-center">
    <% if ShowTitle || Content %>
        <div class="{$ElementName}__contentholder col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4 {$ElementName}__title">$Title</h2>
            <% end_if %>
            <% if $Content %>
            <p class="{$ElementName}__content">$Content</p>
            <% end_if %>
        </div>
    <% end_if %>
    <div class="w-100"></div>
    <% loop Spotlights %>
        <div class="{$ElementName}__spotlight col-12 col-md-4 d-flex flex-column align-items-center my-3">
            <img src="$Image.Fill(800,500).URL" alt="$Title" class="{$ElementName}__spotlight-image img-fluid rounded shadow">
            <% if ShowTitle %>
                <h3 class="{$ElementName}__spotlight-title mt-4">$Title</h3>
            <% end_if %>
            <% if SubTitle %>
                <div class="{$ElementName}__spotlight-subtitle">
                    <lead><strong>$SubTitle</strong></lead>
                </div>
            <% end_if %>
            <p class="{$ElementName}__spotlight-content mt-4 px-3"><i>$Content</i></p>
        <% if CTALink %>
            <% with CTALink %>
                <a {$IDAttr} class="{$ElementName}__spotlight-link mx-1 text-$Up.LinkColor" href="{$LinkURL}"{$TargetAttr}>
                    {$Title}
                </a>
            <% end_with %>
        <% end_if %>
        </div>
    <% end_loop %>
</div>
