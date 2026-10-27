## Feed Bob the small piles

1. Sort ascending; `k = n / 3`.
2. Return `Σ piles[k], piles[k + 2], …` (indices k, k+2, …, n − 2).

`[2,4,1,2,7,8]` → 9. `[2,4,5]` → 4. `[9,8,7,6,5,1,2,3,4]` → 18.

Do not give Bob a large pile; he should get the k smallest. Counting sort makes it O(n) for values ≤ 10^4.

Time: O(n log n)  
Space: O(1) extra

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
