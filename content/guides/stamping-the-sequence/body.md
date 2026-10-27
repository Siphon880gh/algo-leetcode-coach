## Peel off the last stamp first

Let `t` be a list of target letters, `m = len(stamp)`.

Repeat until `t` is all `?` or a full pass changes nothing:

- For each start `i` from 0 to `n − m`: the window matches if for every `j`, `t[i + j] == '?'` or `t[i + j] == stamp[j]`, and at least one `t[i + j]` is not `?`.
- On a match, set the window to `?`, record `i`, and mark progress.

If `t` is all `?`, return the recorded indices reversed; otherwise return `[]`.

A `?` means "covered by a later stamp", so it can be anything when you place this one. Requiring a real letter stops you from recording useless stamps.

Each pass turns at least one letter into `?`, so there are at most `n` passes and at most `n` recorded stamps, well under the `10 · n` limit.

Do not simulate stamping forward; you cannot tell which stamp should go first. Do not record windows that are already all `?`.

Time: O(n² · m) for the simple version  
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
