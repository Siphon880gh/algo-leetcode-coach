## Two remaps

1. `hi`: find the first digit `d ≠ 9`; replace every `d` with 9 (no change if all are 9).
2. `lo`: replace every copy of the first digit with 0.
3. Return `hi − lo`.

Examples → 99009, 99. Checked against all 100 remaps for every num below 3000.

Raising the most significant digit that can still grow matters more than all later digits together. Leading zeros are allowed, so the first digit can always drop to 0.

Time: O(digits)  
Space: O(digits)

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
