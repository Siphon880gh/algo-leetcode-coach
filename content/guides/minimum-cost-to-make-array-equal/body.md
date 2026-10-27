## Treat cost as copies

1. Sort pairs `(nums[i], cost[i])` by value; `half = ceil(Σ cost / 2)`.
2. Walk the pairs, adding costs, until the running sum reaches `half`; that value is `x`.
3. Return `Σ |nums[i] − x| · cost[i]`.

Examples → 8, 0. Checked against trying every target on 300 random cases.

Think of cost[i] as that many copies of nums[i]; the plain median of all copies minimises total distance. Intermediate totals can reach 10^5 · 10^6 · 10^6 = 10^17, so use 64-bit. A ternary or binary search on x also works.

Time: O(n log n)  
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
