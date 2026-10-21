## Search the answer, not the array

`hours(k) = sum((p + k − 1) // k for p in piles)` is non-increasing in `k`.

`lo = 1`, `hi = max(piles)`. While `lo < hi`:

- `mid = (lo + hi) // 2`.
- If `hours(mid) ≤ h`, `hi = mid` (fast enough; try slower).
- Else `lo = mid + 1`.

Return `lo`.

`max(piles)` always works because `h ≥ len(piles)`: one hour per pile.

Do not try every speed from 1 upward; that is O(max · n). Do not use floating-point division for the ceiling.

Time: O(n log max)  
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
