## Smallest card is forced

If `len(hand) % groupSize ≠ 0`, return false.

Count the cards, then go through the distinct values in sorted order. For value `x` with `c = cnt[x] > 0`:

- It must start `c` groups. For each `y` in `x + 1 … x + groupSize − 1`: if `cnt[y] < c`, return false; otherwise `cnt[y] −= c`.
- `cnt[x] = 0`.

Return true.

Handling all `c` copies of `x` at once keeps it O(n log n) for the sort plus O(n · groupSize) at worst.

Do not start groups at arbitrary cards; only the smallest remaining card has a forced role. Do not forget the divisibility check. This is the same problem as 1296.

Time: O(n log n)  
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
