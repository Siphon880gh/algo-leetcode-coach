## The median minimizes total distance

Moves to bring everything to target `t` is `Σ |x − t|`. Moving `t` one step right adds 1 for every value at or left of `t` and saves 1 for every value right of it. The total stops dropping when as many values sit on each side, which is any median. Sort and take `t = nums[n / 2]`, then sum `|x − t|`.

Equivalent pairing view: after sorting, the smallest and largest must meet somewhere between them, costing `nums[n − 1] − nums[0]` no matter where. Pair `i` with `n − 1 − i` and sum the gaps.

Quickselect finds the median in O(n) average time instead of sorting.

Minimum Moves to Equal Array Elements (453) changes `n − 1` elements per move, so its target is the minimum. Best Meeting Point (296) uses the median per axis.

Do not use the mean — `[1,0,0,8,6]` has mean 3 (cost 16) but median 1 (cost 14). Use 64-bit sums while adding distances.

Time: O(n log n) (O(n) average with quickselect)  
Space: O(1) besides sorting

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
