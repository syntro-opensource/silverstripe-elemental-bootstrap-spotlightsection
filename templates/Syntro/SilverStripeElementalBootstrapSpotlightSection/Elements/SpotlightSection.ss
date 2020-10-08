
<div class="py-5 container text-center">
    <div class="row my-5 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4">$Title</h2>
            <% end_if %>
            <p>$Content</p>
        </div>
        <div class="w-100"></div>
        <% loop Spotlights %>
            <div class="col-12 col-md-4 d-flex flex-column align-items-center my-3">
                <img src="$Image.Fill(800,500).URL" alt="$Title" class="img-fluid rounded shadow">
                <% if ShowTitle %>
                    <h3 class="mt-4">$Title</h3>
                <% end_if %>
                <% if SubTitle %>
                    <lead><strong>$SubTitle</strong></lead>
                <% end_if %>
            <p class="mt-4 px-3"><i>$Content</i></p>
            <% if CTALink %>
                <% with CTALink %>
                    <a {$IDAttr} class="mx-1 text-$Up.LinkColor" href="{$LinkURL}"{$TargetAttr}>
                        {$Title}
                    </a>
                <% end_with %>
            <% end_if %>
            </div>
        <% end_loop %>
    </div>
</div>
