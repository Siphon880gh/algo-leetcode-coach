## Children are smaller factors

Every non-leaf node equals the product of its two children, and values are greater than 1, so children are smaller than their parent. Sorting ascending makes every child's count ready before its parent.

For each `x` in sorted order: `dp[x] = 1`. For each smaller `a` with `x % a == 0` and `x / a` in the set: `dp[x] += dp[a] · dp[x / a]`.

Ordered pairs `(a, b)` and `(b, a)` are different trees (left and right children swap), and iterating over every `a` counts both automatically.

Return `Σ dp[x] mod 10⁹ + 7`.

Do not count only `a ≤ b`; swapped children are distinct trees. Do not forget the single-node tree for every value.

Time: O(n²)  
Space: O(n)

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
