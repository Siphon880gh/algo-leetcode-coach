## Sort, then look at two gaps

Sort to `x < y < z`.

- Max moves: `z − x − 2` (each move can fill one empty slot between the ends).
- Min moves:
  - 0 if `y − x == 1` and `z − y == 1`.
  - 1 if `y − x ≤ 2` or `z − y ≤ 2` (one end stone jumps next to the others, or into the single hole).
  - Otherwise 2.

Return `[min, max]`.

Do not simulate moves; three numbers decide everything. Do not count the case of a gap of 2 as two moves; one stone can jump into the hole.

Time: O(1)  
Space: O(1)

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
