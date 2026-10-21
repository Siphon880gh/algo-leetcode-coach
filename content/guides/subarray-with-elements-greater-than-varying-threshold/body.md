## Widest window per minimum

1. `L[i]` = index of the previous smaller element (or −1), `R[i]` = next smaller or equal (or n), from one stack pass.
2. For each `i`: `k = R[i] − L[i] − 1`; if `nums[i] · k > threshold`, return `k`.
3. Return −1.

Examples → 3, 3 (any valid size is accepted; Example 2 lists 1 to 5). Checked against testing every subarray on 500 random cases.

A window works exactly when its minimum times its length beats threshold, and for a fixed minimum the widest window is best. Compare `nums[i] · k > threshold` in 64-bit to avoid division.

Time: O(n)  
Space: O(n)

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
