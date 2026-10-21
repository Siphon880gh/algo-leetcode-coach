## Look for prefix − 1

`s = 0`, `first = {}`, `ans = 0`. For each day `i`:

1. `s += 1 if hours[i] > 8 else −1`.
2. If `s > 0`: `ans = i + 1`.
3. Else if `s − 1` is in `first`: `ans = max(ans, i − first[s − 1])`.
4. If `s` is not in `first`: `first[s] = i`.

Return `ans`.

Prefix sums move by 1 each day, so the earliest index with any value below `s` is the earliest with `s − 1`; that gives the longest interval ending at `i`.

Do not use a sliding window; the score is not monotone in the window size. A monotonic stack of decreasing prefixes is an alternative O(n) method.

Time: O(n)  
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
