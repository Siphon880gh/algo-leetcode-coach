## Pushes are the only cost

1. State `(box, player)`; start from the `B` and `S` cells with cost 0.
2. From a state, for each direction the player tries the next cell `np`:
   - `np` is a wall: skip.
   - `np` is the box: the box moves to `box + dir` if that is free; cost + 1, push to the back.
   - Otherwise: the player walks; cost + 0, push to the front.
3. Return the cost when the box reaches `T`, or −1.

Example 1 → 3. Example 2 → −1. Example 3 → 5.

Do not BFS on box positions alone; whether a push is possible depends on where the player can stand. Do not count player steps; only pushes are counted.

Time: O((m · n)²) states  
Space: O((m · n)²)

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
