## Add the keys to the state

There are at most 6 keys, so a mask has at most 64 values and there are `m · n · 64` states.

1. Find the start `@` and count the keys to get `full = (1 << K) − 1`.
2. BFS from `(sr, sc, 0)`.
3. For a step into `(r, c)`:
   - `#` or out of bounds: skip.
   - A lock `A`–`F`: skip unless bit `lock − 'A'` is in the mask.
   - A key `a`–`f`: the new mask is `mask | 1 << (key − 'a')`.
4. If the new mask is `full`, return the current distance + 1. Otherwise enqueue the state if unseen.

Return −1 if the queue empties.

Do not mark cells visited without the mask; you may need to walk back through a cell after picking up a key. Do not run a separate search per key order; the mask BFS covers all orders at once.

Time: O(m · n · 2^K)  
Space: O(m · n · 2^K)

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
