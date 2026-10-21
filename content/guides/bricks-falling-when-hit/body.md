## Reverse time

1. Copy the grid and remove every hit brick (a hit on an empty cell does nothing; remember that).
2. Union-find with sizes over cells, plus a virtual `ROOF` node. Union every remaining brick with its brick neighbors, and every top-row brick with `ROOF`.
3. Process hits in reverse. For hit `(r, c)` that originally had a brick:
   - `before = size(ROOF)`.
   - Restore the brick; union it with `ROOF` if `r == 0`, and with each brick neighbor.
   - `after = size(ROOF)`. The answer for this hit is `max(0, after − before − 1)`: the bricks reattached to the roof, excluding the restored brick.
4. Hits on empty cells answer 0.

Undoing a hit in reverse is exactly what that hit knocked loose going forward.

Do not run a BFS from the roof after every hit; that is O(hits · m · n). Do not count the restored brick itself as fallen.

Time: O((m · n + hits) · α)  
Space: O(m · n)

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
