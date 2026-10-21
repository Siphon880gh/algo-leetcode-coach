## Two directions, one helper

1. `f(a, b)`: for each `x` in a, `t = x²`; for each distinct `y` in b with `t % y == 0`, `z = t / y`: add `c[y]·(c[y] − 1)` if `z == y`, else `c[y]·c[z]`. Halve the total (each unordered pair is seen twice).
2. Answer `f(nums1, nums2) + f(nums2, nums1)`.

`[7,4]`, `[5,2,8,9]` → 1. `[1,1]`, `[1,1,1]` → 9. `[7,7,8,3]`, `[1,2,9,7]` → 2.

Use 64-bit for `x²` (up to 10^10). Do not forget the second direction.

Time: O(n · m)  
Space: O(m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
