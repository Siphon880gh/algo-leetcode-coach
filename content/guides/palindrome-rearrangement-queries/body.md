## Two strings, two ranges

1. A = s[0 … n/2 − 1], B = reverse(s[n/2 … n − 1]). A query’s [c, d] becomes [n − 1 − d, n − 1 − c] in B.
2. Prefix letter counts for A and B, and a prefix count of positions where A[i] ≠ B[i].
3. Per query: A and B must have the same letters overall, and no mismatch may lie outside both ranges.
   - Disjoint ranges: each range must hold the same letters in A and in B.
   - One range inside the other: the outer range must hold the same letters in A and B.
   - Partial overlap with A’s range [a, b] first: A[a … b] must supply B[a … c − 1], and B[c … d] must supply A[b + 1 … d]; every letter count left over must be ≥ 0. The other order is symmetric.

Examples → [true, true], [false], [true]. Checked against trying every rearrangement on 2,500 random small cases.

n and the number of queries reach 10^5, so each query must be O(26).

Time: O(26 (n + q))  
Space: O(26 n)

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
