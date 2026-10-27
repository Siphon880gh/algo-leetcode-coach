## Candidate, then verify

**Build:** a segment tree whose node holds `(cand, cnt)`. Merge `(a, x)` and `(b, y)`: if `a == b`, `(a, x + y)`; else the larger count wins with `|x − y|`.

**Index lists:** `pos[v]` = sorted indices where `arr[i] == v`.

**query(left, right, threshold):**
1. Combine nodes covering `[left, right]` to get `cand`.
2. `freq = bisect_right(pos[cand], right) − bisect_left(pos[cand], left)`.
3. Return `cand` if `freq ≥ threshold`, else −1.

Because `2 · threshold > right − left + 1`, an answer must be a strict majority, and the vote always finds it if one exists.

Do not trust the vote count as the frequency; it is only a lower bound. Do not scan the range per query; 10⁴ queries over 2 · 10⁴ elements is too slow.

Time: O(n) build, O(log n) per query  
Space: O(n)

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
