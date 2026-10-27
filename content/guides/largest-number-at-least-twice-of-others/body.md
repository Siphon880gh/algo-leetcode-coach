## Only the runner-up matters

If the maximum is at least twice the second largest, it is at least twice every other value too.

One pass: keep `first` (with its index) and `second`. For each `x`: if `x > first`, shift `second = first` and set `first = x`; else if `x > second`, set `second = x`.

Return the index of `first` if `first ≥ 2 · second`, else `-1`.

The largest value is unique by the constraints, and a single-element array returns 0.

Do not check against every element in a second loop; one comparison is enough. Do not initialize `second` with the first element; start from −∞ or 0 (values are non-negative).

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
