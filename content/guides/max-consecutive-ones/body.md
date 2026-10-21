## One counter

Walk the array with `cnt = 0` and `best = 0`. On a 1, `cnt += 1` and `best = max(best, cnt)`. On a 0, `cnt = 0`. Updating `best` on every 1 (not only at zeros) handles a run that ends at the last index.

Max Consecutive Ones II (487) allows flipping one 0, and Max Consecutive Ones III (1004) allows `k` flips — those need a sliding window that tracks zeros inside it.

Do not update `best` only when you see a 0 — the final run would be missed. Do not count total 1s.

Time: O(n)  
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
