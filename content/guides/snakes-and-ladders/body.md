## Squares as nodes

Square `s` (1-based) is at:

- `r = (s − 1) // n`, `c = (s − 1) % n`;
- `row = n − 1 − r`; if `r` is odd, `c = n − 1 − c` (the zigzag).

BFS from 1 with `dist[1] = 0`:

1. Pop `s`. For `next` in `s + 1 … min(s + 6, n²)`:
2. If `board[row][col]` of `next` is not −1, jump: `next = board[row][col]`. Only one jump per move, even if it lands on another snake or ladder.
3. If `next == n²`, return `dist[s] + 1`. If unseen, record and enqueue.

Return −1.

Mark squares seen after the jump, so the destination is what counts.

Do not chain jumps. Do not forget the zigzag on odd rows from the bottom.

Time: O(n²)  
Space: O(n²)

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
