## Which position is revealed k-th?

1. Sort `deck` ascending.
2. `q = deque(range(n))`.
3. For each card in sorted order:
   - `res[q.popleft()] = card` (this position is revealed next).
   - If `q` is not empty, move the next index to the back: `q.append(q.popleft())`.

Return `res`.

The queue replays the rule "reveal the top, move the next card to the bottom" on positions, so the k-th smallest card lands where the k-th reveal happens.

The reverse approach also works: go through the cards from largest to smallest, rotating the bottom card to the top before each placement.

Do not try permutations. Do not forget to skip the rotation after the last reveal.

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
