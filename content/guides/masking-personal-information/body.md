## Email

Lowercase everything. With `name@domain`, return `name[0] + "*****" + name[-1] + "@" + domain`. Always exactly five stars, whatever the name length.

## Phone

Keep only the digits. The last 10 are the local number, and any extra digits (0 to 3) are the country code.

- Local part: `"***-***-" + digits[-4:]`.
- Country code of length `k > 0`: prefix `"+" + "*" · k + "-"`.

Do not keep the separators `+`, `-`, `(`, `)`, or spaces from the input. Do not vary the number of stars with the name length.

Time: O(n)  
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
