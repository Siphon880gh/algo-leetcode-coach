## Split by the smallest gap

1. `s` sorted; repeat n times:
   - `d = s[1] − s[0]`; greedily pair each remaining smallest `x` with `x + d` → lists `A` (the `x`s) and `B` (the `x + d`s).
   - If `0 ∈ A`: record `d`, `s = A`; else record `−d`, `s = B`.

Example 1 → `[1,2,-3]`. Example 2 → `[0,0]`. Example 3 → `[0,-1,4,5]`. Checked by regenerating subset sums on random arrays.

The group containing 0 is the set of sums of the remaining elements (it includes the empty subset). Each round halves the list.

Time: O(n · 2^n)  
Space: O(2^n)

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
