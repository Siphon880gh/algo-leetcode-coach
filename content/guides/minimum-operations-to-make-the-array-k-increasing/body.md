## Split, then patience-sort

1. For `s = 0 … k − 1`: chain `arr[s], arr[s + k], …`.
2. LNDS with tails and `bisect_right` (non-decreasing allows equal values).
3. Add `len(chain) − LNDS`.

Examples → 4, 0, 2. Checked against trying every set of kept indices on small random arrays.

Changed values can be any positive integer, so any kept non-decreasing subsequence can be completed around. `bisect_right` rather than `bisect_left` is what lets equal values stay.

Time: O(n log n)  
Space: O(n / k)

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
