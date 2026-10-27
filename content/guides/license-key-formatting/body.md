## Group from the right

Only the first group may be short, so the grouping is fixed from the end. Walk `s` backward, skip dashes, append uppercase characters, and after every `k` kept characters append a dash. Remove a trailing dash at the very end of the build (that would become a leading dash), then reverse.

Forward alternative: let `m` be the count of non-dash characters. The first group has `m % k` characters, or `k` if that is 0. Emit characters forward and add a dash at each group end except the last.

Reformat Phone Number (1694) groups digits by threes and twos with a special tail. Add Bold Tag (616) is unrelated string building.

Do not keep the original dashes. Do not make the last group short instead of the first. Handle input that is all dashes (`"---"` → `""`).

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
