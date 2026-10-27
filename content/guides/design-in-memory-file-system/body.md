Design `FileSystem` with four calls. `ls(path)` returns `[name]` if `path` is a file, or the sorted names inside it if `path` is a directory. `mkdir(path)` creates the directory and any missing parents. `addContentToFile(filePath, content)` creates the file if needed and appends `content`. `readContentFromFile(filePath)` returns the file's content. Paths are absolute, like `/a/b/c`. `mkdir("/a/b/c")`, `addContentToFile("/a/b/c/d", "hello")`, `ls("/")` → `["a"]`, `readContentFromFile("/a/b/c/d")` → `"hello"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One trie node per path part

`Node`: `children` (a map from name to node), `is_file`, `content`.

- `walk(path, create)`: split on `/`, skip the empty parts, and step through `children`, creating nodes when `create` is true.
- `mkdir`: `walk(path, True)`.
- `addContentToFile`: `node = walk(path, True)`, set `is_file = True`, and append the content.
- `readContentFromFile`: `walk(path, False).content`.
- `ls`: `node = walk(path, False)`. If `node.is_file`, return the last part of the path. Otherwise return `sorted(node.children)`.

`ls("/")` is the root itself, because splitting `/` leaves no parts.

Do not return the sorted children for a file path; `ls` on a file returns just its name. Do not overwrite on `addContentToFile`; it appends.

Time: O(path length) per call, plus O(k log k) to sort k names in `ls`  
Space: O(total path parts + content)

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
