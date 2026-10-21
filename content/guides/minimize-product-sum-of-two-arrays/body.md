Given two equal-length integer arrays, the product sum is the sum of a[i] · b[i]. You may rearrange the first array (as the statement allows); return the minimum possible product sum. For instance, [5,3,4,2] and [4,2,2,5] → 40, and [2,1,4,5,7] and [3,2,4,8,6] → 65. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Opposite orders

1. Sort `a` ascending and `b` descending.
2. Return `Σ a[i] · b[i]`.

Constructed checks (verified against every permutation): the two cases above → 40 and 65.

Exchange argument: if `a[i] < a[j]` and `b[i] < b[j]`, swapping `b[i]` and `b[j]` does not increase the sum. Only the pairing matters, so rearranging either array gives the same answer.

Time: O(n log n), or O(n + V) with counting sort  
Space: O(1) besides sorting

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
