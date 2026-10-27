## Decide first, edit second

1. `match = {}`. For each operation `k`, if `s.startswith(sources[k], indices[k])`, set `match[indices[k]] = k`.
2. Build the output with `i = 0`: if `i` is in `match`, append `targets[k]` and jump `i += len(sources[k])`; otherwise append `s[i]` and `i += 1`.

The problem guarantees matching replacements do not overlap, so one left-to-right pass is enough.

**Alternative:** sort the matching operations by index in descending order and splice from the right, so earlier indexes stay valid.

Do not apply replacements left to right on the live string; each one shifts the later indexes. Do not assume the operations are sorted by index.

Time: O(n + Σ|source| + Σ|target|)  
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
