Given an integer array nums of non-negative values and an integer k, return the largest even sum of any subsequence of nums of length k, or −1 if no such sum exists. For instance, [4,1,5,3,1] with k = 3 → 12; [4,6,2] with k = 3 → 12; [1,3,5] with k = 1 → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fix the parity with one exchange

1. Sort descending; `top` = first k, `t` = their sum.
2. `t` even → return `t`.
3. Candidates: `t − min odd in top + max even outside`, and `t − min even in top + max odd outside` (when both parts exist).
4. Return the larger, or −1.

Constructed checks (verified against every k-subset on random arrays): the three cases above → 12, 12, −1.

Changing parity needs swapping an odd for an even or the reverse; doing it with the smallest loss is one swap, and two swaps would never beat it.

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
