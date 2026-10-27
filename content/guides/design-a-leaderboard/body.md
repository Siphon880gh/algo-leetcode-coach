Design a leaderboard with `addScore(playerId, score)` (add to a player's score, creating the player if needed), `top(K)` (sum of the K highest scores), and `reset(playerId)` (set that player's score back to 0, or remove them). For instance, after adding 73, 56, and 39 for players 1, 2, and 3, `top(1)` is 73; after `reset(1)`, `top(2)` is 95. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map plus selection

- `addScore(p, s)`: `score[p] = score.get(p, 0) + s`.
- `reset(p)`: delete `score[p]` (or set it to 0).
- `top(K)`: `sum(heapq.nlargest(K, score.values()))`.

`nlargest` runs in O(n log K). With many `top` calls, a sorted container keyed by score makes `top` O(K) and updates O(log n).

Do not keep a fully sorted list and re-sort on each `addScore`; that is O(n log n) per update. Do not forget players created by `addScore` after a reset.

Time: O(1) for add and reset, O(n log K) for top  
Space: O(n)

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
