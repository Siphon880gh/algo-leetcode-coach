## Minimax with memo

1. Moves: stay, or jump 1 … J cells in a straight line until a wall or the edge.
2. Mouse turn: true if any move hits food, or (not the cat's cell and) leads to a true state.
3. Cat turn: false if any move hits food or the mouse; true only if every move leads to a true state.
4. Stop at a turn cap (about `2 · rows · cols` is a common choice) → cat wins.

`["####F","#C...","M...."]`, 1, 2 → true. `["M.C...F"]`, 1, 4 → true. Same grid, 1, 3 → false.

The 1000-turn rule from the statement would make memo states huge; the smaller cap works because repeating positions cannot help the mouse. Topological (retrograde) analysis is the fully rigorous alternative.

Time: O(cap · (R·C)² · (R + C))  
Space: O(cap · (R·C)²)

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
