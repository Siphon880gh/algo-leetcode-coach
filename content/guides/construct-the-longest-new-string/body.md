## Formula

1. `k = 2 · min(x, y) + (1 if x ≠ y else 0) + z` pieces.
2. Return `2k`.

Examples → 12, 14. Checked against a search over every order for all x, y ≤ 6, z ≤ 4.

The extra piece matters: BB AA BB AA BB uses one more BB than AA, so x = 2, y = 5, z = 1 without it → 10 instead of 12. AB pieces chain with each other and sit before AA or after BB without making AAA or BBB.

Time: O(1)  
Space: O(1)

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
