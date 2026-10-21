## Append, then search

`set(key, value, t)`: append `(t, value)` to `store[key]`.

`get(key, t)`:

1. If the key is missing, return `""`.
2. Find the last index `i` with `times[i] ≤ t` (bisect right minus one).
3. Return `values[i]`, or `""` if `i < 0`.

Keeping timestamps and values in two parallel lists makes the bisect simple.

Do not scan the whole list on each get; that is O(n) per call. Do not sort on every set; the timestamps arrive in increasing order.

Time: O(1) per set, O(log n) per get  
Space: O(total sets)

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
