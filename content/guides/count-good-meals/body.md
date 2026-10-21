## 22 powers per element

1. `cnt = Counter()`, `res = 0`.
2. For `x`: `res += Σ cnt[2^p − x]` for `p = 0 … 21`; `cnt[x] += 1`.
3. Return `res` mod 1e9+7.

`[1,3,5,7,9]` → 4. `[1,1,1,3,3,3,7]` → 15.

Counting only earlier elements avoids double counting and self-pairs. Do not check all pairs (n up to 10^5).

Time: O(22 · n)  
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
