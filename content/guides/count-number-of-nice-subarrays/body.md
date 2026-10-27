## Prefix odd counts

1. `seen = {0: 1}`, `odd = 0`, `ans = 0`.
2. For each `x`: `odd += x % 2`; `ans += seen.get(odd − k, 0)`; `seen[odd] += 1`.
3. Return `ans`.

`[1,1,2,1,1]`, k = 3 → 2. `[2,2,2,1,2,2,1,2,2,2]`, k = 2 → 16.

Equivalent: `atMost(k) − atMost(k − 1)` with a sliding window.

Do not use a plain sliding window for "exactly k"; even numbers at the edges make several valid windows. Do not forget `seen[0] = 1` for subarrays starting at index 0.

Time: O(n)  
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
