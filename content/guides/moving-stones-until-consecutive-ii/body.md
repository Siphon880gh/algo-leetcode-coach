## Sort, then two formulas

Sort `s`, `n = len(s)`.

- Max: `max(s[n − 1] − s[1], s[n − 2] − s[0]) − n + 2`. The first move gives up one end gap; every later move fills one empty slot.
- Min: slide `i` and `j` so that `s[j] − s[i] + 1 ≤ n` (a window of `n` slots). For each window with `k = j − i + 1` stones:
  - If `k == n − 1` and `s[j] − s[i] + 1 == n − 1` (a full block with the last stone far away), the cost is 2.
  - Otherwise the cost is `n − k`.

  Keep the minimum.

Do not simulate moves; `n` reaches 10⁴ and positions reach 10⁹. Do not miss the special case: an end stone cannot move to the slot right next to the block, because it would still be an end.

Time: O(n log n)  
Space: O(1) beyond the sort

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
