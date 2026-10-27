## Membership per array

1. `s1, s2, s3` = sets of the three arrays.
2. Return `[v for v in s1 ∪ s2 ∪ s3 if (v ∈ s1) + (v ∈ s2) + (v ∈ s3) ≥ 2]`.

Examples → `[3,2]`, `[2,3,1]`, `[]` (any order).

Sets matter: `[1,1,3,2]` must not count 1 twice for one array. With values ≤ 100 a 3-bit mask per value works too: `mask[v] |= 1 << k`, keep masks with popcount ≥ 2.

Time: O(n1 + n2 + n3)  
Space: O(V)

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
