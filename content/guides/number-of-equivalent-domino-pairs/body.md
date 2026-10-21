## Canonical key

`cnt = {}`, `ans = 0`. For each `[a, b]`:

- `key = (min(a, b), max(a, b))` (or `10 · min + max`, since values are 1 to 9).
- `ans += cnt.get(key, 0)`; `cnt[key] += 1`.

Return `ans`.

Adding before incrementing counts each pair once. Equivalently, sum `c · (c − 1) / 2` over the final counts.

Do not compare every pair of dominoes; that is O(n²). Do not forget that `[1,2]` and `[2,1]` are the same domino.

Time: O(n)  
Space: O(1) with the 100-slot array

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
