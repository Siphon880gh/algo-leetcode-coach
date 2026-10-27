## Content is the key

Each line looks like `"root/a 1.txt(abcd) 2.txt(efgh)"`.

1. Split on spaces: the first token is the directory, and every other token is `name(content)`.
2. For each file, split at the first `(`: `name` is before it, `content` is between it and the final `)`.
3. Append `directory + "/" + name` to `groups[content]`.

Return every list in `groups` with at least two paths.

Follow-ups: for a real file system, group by file size first, then hash only the files with the same size, then compare bytes of the candidates to rule out hash collisions.

Do not key by file name; duplicates are about content, and names can repeat across folders. Do not return groups of one path.

Time: O(total input length)  
Space: O(total input length)

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
