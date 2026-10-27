## Clashes, then helpers

1. `bad` = indices with `nums1[i] = nums2[i]`; `cost = Σ bad`, `t = |bad|`.
2. Let `v` be the most common value among them, with count `m`.
3. For `j = 0, 1, …` while `2m > t`: if `nums1[j] ≠ nums2[j]`, `nums1[j] ≠ v` and `nums2[j] ≠ v`, add `j` to `cost` and `t++`.
4. Return `cost` if `2m ≤ t`, else −1.

Examples → 10, 10, −1. Checked against a shortest-path search over every swap sequence on 300 random cases with n ≤ 6.

Each clashing index must be in some swap, costing at least its own index. When no value fills more than half, the clashes can be swapped among themselves, each one used once. Otherwise copies of v would collide again, and each helper must hold v in neither array. The cost can reach about 5 · 10^9, so use 64-bit.

Time: O(n)  
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
