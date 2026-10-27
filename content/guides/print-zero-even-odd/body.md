## The zero thread directs traffic

Semaphores `zeroTurn = 1`, `oddTurn = 0`, `evenTurn = 0`.

- `zero`: for `i` from 1 to `n`: `zeroTurn.acquire()`; print 0; release `oddTurn` if `i` is odd, else `evenTurn`.
- `odd`: for each odd `i` up to `n`: `oddTurn.acquire()`; print `i`; `zeroTurn.release()`.
- `even`: for each even `i` up to `n`: `evenTurn.acquire()`; print `i`; `zeroTurn.release()`.

Each worker loops exactly as many times as it has numbers to print, so no thread waits forever at the end.

Do not let the odd and even threads coordinate with each other directly; routing every turn through zero keeps it simple. Do not loop the even thread `n` times; it prints only `n // 2` numbers.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
