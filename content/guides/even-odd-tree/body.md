## Check each level

1. BFS level by level with `prev` reset per level.
2. Even level: value odd and `> prev`. Odd level: value even and `< prev`.
3. Any violation → false; otherwise true.

`[1,10,4,3,null,7,9,12,8,6,null,null,2]` → true. `[5,4,2,3,3,7]` → false (level 2 not increasing). `[5,9,1,3,5,7]` → false (level 1 has odd values).

Levels are 0-indexed, so the root must be odd. Do not allow equal neighbours; ordering is strict.

Time: O(n)  
Space: O(width)

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
