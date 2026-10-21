## Min-heap of ends

1. Sort events by start; `day` starts at the first start.
2. Push the ends of all events with `start ≤ day`.
3. Pop ends `< day`; if the heap is non-empty, pop one, count it.
4. `day += 1`; when the heap is empty, jump `day` to the next start.

`[[1,2],[2,3],[3,4]]` → 3. `[[1,2],[2,3],[3,4],[1,2]]` → 4.

Do not attend the event that started first; the one ending first is the safe choice. Do not loop over every day up to 10⁵ when the heap is empty; jump ahead.

Time: O((n + D) log n)  
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
