## Which side of the peak is mid on?

`lo = 0`, `hi = n − 1`. While `lo < hi`:

- `mid = (lo + hi) // 2`.
- If `arr[mid] < arr[mid + 1]`, you are going uphill: `lo = mid + 1`.
- Otherwise you are at the peak or going downhill: `hi = mid`.

Return `lo`.

`mid + 1` is always in range because `mid < hi`.

Do not use `hi = mid − 1` in the second branch; `mid` may be the peak. Do not scan linearly; the problem asks for O(log n).

Time: O(log n)  
Space: O(1)

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
