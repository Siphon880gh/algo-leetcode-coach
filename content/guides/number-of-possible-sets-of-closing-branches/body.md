## Enumerate and Floyd

1. For each mask: distances from the shortest road between kept branches (keep the minimum of parallel roads).
2. Floyd–Warshall with middle points in the mask.
3. Count the mask if every kept pair is ≤ maxDistance (empty and single sets count).

Examples → 5, 7, 2.

Closed branches lose their roads, so paths may not pass through them: allowing that gives example 2 → 8 instead of 7.

Time: O(2^n · n³)  
Space: O(n²)

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
