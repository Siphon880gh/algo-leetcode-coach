## Land on the highest overlap

Square `i` covers `[left, left + side)`; the right end is open, so touching edges do not stack.

**O(n²):** keep each landed square's interval and top. For a new square, `base` is the max top over earlier squares that overlap, `l1 < r2 and l2 < r1`. Its top is `base + side`. The answer after each drop is the running max of all tops.

**O(n log n):** compress every `left` and `left + side − 1` endpoint. A segment tree supports two operations: query the max on a range, and set a whole range to a value (lazy assignment). Each drop runs `h = query(l, r) + side`, then `assign(l, r, h)`.

Do not treat touching squares as overlapping; `[1,2]` and `[3,…]` share only the edge at 3. Do not report only the newest square's height; the answer is the tallest stack so far.

Time: O(n²) simple, O(n log n) with the tree  
Space: O(n)

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
