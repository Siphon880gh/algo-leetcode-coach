## Jump piece by piece

1. `first = {p[0]: p for p in pieces}`.
2. `i = 0`; while `i < n`: if `arr[i]` not in `first`, false; else check `arr[i : i + len(p)] == p`; `i += len(p)`.
3. Return true.

`[15,88]`, `[[88],[15]]` → true. `[49,18,16]`, `[[16,18,49]]` → false (pieces cannot be reordered inside). `[91,4,64,78]`, `[[78],[4,64],[91]]` → true.

Distinct values make the lookup unique. Do not sort the pieces internally.

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
