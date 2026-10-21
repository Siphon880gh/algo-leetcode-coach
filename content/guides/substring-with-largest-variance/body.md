## 26 · 25 Kadane runs

1. For each pair `a ≠ b` present in `s`: `ca = cb = 0`, `rem` = count of `b`.
2. For each character: `a` → `ca++`; `b` → `cb++`, `rem−−`; if `cb > 0`, `best = max(best, ca − cb)`; if `ca < cb` and `rem > 0`, reset both to 0.
3. Return `best`.

Examples → 3, 0. Checked against counting every substring on 400 random strings.

Plain Kadane would allow a window with no `b`, giving a variance with an absent letter. Keeping the window when no `b` is left lets a later run of `a`s still pair with an earlier `b`.

Time: O(26² · n)  
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
